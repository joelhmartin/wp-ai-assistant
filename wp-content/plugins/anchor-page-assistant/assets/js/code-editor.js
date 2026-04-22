/**
 * Anchor Page Assistant — Code Editor Panel
 *
 * Loads Monaco on demand and opens a slide-over panel to edit the
 * current page's page-content/{slug}.php file directly.
 *
 * Depends on window.apaFrontend (from wp_localize_script in
 * class-frontend-chat.php) and calls back into window.APA.codeEditor
 * so the main chat widget can wire its "Edit code" button to `open()`.
 */
(function () {
	'use strict';

	var data = window.apaFrontend;
	if ( ! data || ! data.restBase ) return;

	var MONACO_VS = 'https://cdn.jsdelivr.net/npm/monaco-editor@0.45.0/min/vs';

	var state = {
		monacoLoaded: false,
		monacoLoading: false,
		editor: null,
		container: null,
		originalContents: '',
		currentSlug: '',
		onSaveCallback: null,
	};

	/**
	 * Lazily load Monaco via its AMD loader. Resolves once the
	 * `monaco` global is ready.
	 */
	function loadMonaco() {
		if ( state.monacoLoaded ) return Promise.resolve();
		if ( state.monacoLoading ) {
			return new Promise( function ( resolve ) {
				var iv = setInterval( function () {
					if ( state.monacoLoaded ) {
						clearInterval( iv );
						resolve();
					}
				}, 50 );
			} );
		}
		state.monacoLoading = true;

		return new Promise( function ( resolve, reject ) {
			var loader = document.createElement( 'script' );
			loader.src = MONACO_VS + '/loader.min.js';
			loader.onload = function () {
				/* global require */
				require.config( { paths: { vs: MONACO_VS } } );
				require( [ 'vs/editor/editor.main' ], function () {
					state.monacoLoaded = true;
					state.monacoLoading = false;
					resolve();
				} );
			};
			loader.onerror = function () {
				state.monacoLoading = false;
				reject( new Error( 'Failed to load Monaco loader.' ) );
			};
			document.head.appendChild( loader );
		} );
	}

	function buildPanel() {
		if ( state.container ) return state.container;

		var root = document.createElement( 'div' );
		root.className = 'apa-code-panel';
		root.id = 'apa-code-panel';
		root.innerHTML =
			'<div class="apa-code-header">' +
				'<div class="apa-code-title">' +
					'<strong>Page Code</strong>' +
					'<span class="apa-code-path"></span>' +
				'</div>' +
				'<div class="apa-code-actions">' +
					'<button class="apa-code-btn apa-code-btn--ghost" id="apa-code-revert">Revert</button>' +
					'<button class="apa-code-btn" id="apa-code-save">Save</button>' +
					'<button class="apa-code-btn apa-code-btn--close" id="apa-code-close" title="Close">&times;</button>' +
				'</div>' +
			'</div>' +
			'<div class="apa-code-status" id="apa-code-status" hidden></div>' +
			'<div class="apa-code-host" id="apa-code-host"></div>';

		document.body.appendChild( root );

		root.querySelector( '#apa-code-close' ).addEventListener( 'click', close );
		root.querySelector( '#apa-code-revert' ).addEventListener( 'click', revert );
		root.querySelector( '#apa-code-save' ).addEventListener( 'click', save );

		state.container = root;
		return root;
	}

	function setStatus( text, kind ) {
		var el = state.container && state.container.querySelector( '#apa-code-status' );
		if ( ! el ) return;
		if ( ! text ) {
			el.hidden = true;
			el.textContent = '';
			el.className = 'apa-code-status';
			return;
		}
		el.hidden = false;
		el.textContent = text;
		el.className = 'apa-code-status apa-code-status--' + ( kind || 'info' );
	}

	function open( slug, onSave ) {
		state.currentSlug = slug;
		state.onSaveCallback = onSave || null;

		buildPanel();
		state.container.classList.add( 'is-open' );
		setStatus( 'Loading…', 'info' );

		// Show the path immediately, even before contents load.
		var pathEl = state.container.querySelector( '.apa-code-path' );
		if ( pathEl ) pathEl.textContent = 'page-content/' + slug + '.php';

		// Load Monaco + the file in parallel.
		Promise.all( [ loadMonaco(), fetchFile( slug ) ] )
			.then( function ( results ) {
				var file = results[ 1 ];
				var contents = file.contents || '<?php\n// New file. Add your PHP/HTML here.\n';
				state.originalContents = contents;
				mountEditor( contents );
				setStatus( file.exists ? '' : 'New file — will be created on save.', file.exists ? 'info' : 'warn' );
			} )
			.catch( function ( err ) {
				setStatus( 'Error: ' + err.message, 'error' );
			} );
	}

	function close() {
		if ( state.container ) state.container.classList.remove( 'is-open' );
	}

	function fetchFile( slug ) {
		return fetch( data.restBase + 'files/page/' + encodeURIComponent( slug ), {
			headers: { 'X-WP-Nonce': data.nonce },
		} ).then( function ( r ) {
			return r.json().then( function ( body ) {
				if ( ! r.ok ) throw new Error( body.error || ( 'HTTP ' + r.status ) );
				return body;
			} );
		} );
	}

	function mountEditor( contents ) {
		var host = state.container.querySelector( '#apa-code-host' );
		host.innerHTML = '';

		state.editor = window.monaco.editor.create( host, {
			value: contents,
			language: 'php',
			theme: 'vs-dark',
			automaticLayout: true,
			fontSize: 13,
			minimap: { enabled: false },
			scrollBeyondLastLine: false,
			wordWrap: 'on',
			tabSize: 4,
		} );

		state.editor.addCommand(
			window.monaco.KeyMod.CtrlCmd | window.monaco.KeyCode.KeyS,
			save
		);
	}

	function revert() {
		if ( state.editor ) {
			state.editor.setValue( state.originalContents );
			setStatus( 'Reverted to last loaded contents.', 'info' );
		}
	}

	function save() {
		if ( ! state.editor ) return;

		var contents = state.editor.getValue();
		var saveBtn = state.container.querySelector( '#apa-code-save' );
		saveBtn.disabled = true;
		saveBtn.textContent = 'Saving…';
		setStatus( 'Writing file…', 'info' );

		fetch( data.restBase + 'files/page/' + encodeURIComponent( state.currentSlug ), {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-WP-Nonce': data.nonce,
			},
			body: JSON.stringify( { contents: contents } ),
		} )
			.then( function ( r ) {
				return r.json().then( function ( body ) {
					return { ok: r.ok, status: r.status, body: body };
				} );
			} )
			.then( function ( res ) {
				saveBtn.disabled = false;
				saveBtn.textContent = 'Save';

				if ( ! res.ok || ! res.body.success ) {
					var msg = ( res.body && res.body.error ) || ( 'HTTP ' + res.status );
					setStatus( 'Save failed: ' + msg, 'error' );
					return;
				}

				state.originalContents = contents;
				setStatus( 'Saved.', 'ok' );

				if ( typeof state.onSaveCallback === 'function' ) {
					try {
						state.onSaveCallback( { slug: state.currentSlug, path: res.body.path } );
					} catch ( e ) {
						/* noop */
					}
				}
			} )
			.catch( function ( err ) {
				saveBtn.disabled = false;
				saveBtn.textContent = 'Save';
				setStatus( 'Save failed: ' + err.message, 'error' );
			} );
	}

	// Expose API for the main chat widget to drive.
	window.APA = window.APA || {};
	window.APA.codeEditor = {
		open:  open,
		close: close,
	};
})();
