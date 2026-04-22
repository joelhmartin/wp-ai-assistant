<?php
/**
 * Page config: home
 */
return [
    'sections' => [
        [
            'type' => 'deka_hero',
            'props' => [
                'meta_left' => 'Deka · Est. 1981 · Florence, Italy',
                'meta_right' => 'No. 01 / Homepage',
                'heading_lines' => [
                    [
                        'text' => 'The standard',
                    ],
                    [
                        'text' => 'of ',
                        'italic' => 'precision light',
                    ],
                    [
                        'text' => 'in modern dentistry.',
                    ],
                ],
                'sub' => 'For more than four decades, DEKA has engineered the lasers that define the world\'s most demanding dental practices — instruments of clinical certainty, crafted in Florence.',
                'stats' => [
                    [
                        'num' => '44',
                        'sup' => 'yrs',
                        'cap' => 'Italian engineering',
                    ],
                    [
                        'num' => '30k',
                        'sup' => '+',
                        'cap' => 'Systems placed worldwide',
                    ],
                ],
                'primary_cta' => [
                    'label' => 'Explore the Instruments',
                    'url' => '#products',
                ],
                'background_video' => [
                    'enabled' => true,
                    'url' => 'https://www.youtube.com/embed/oKwaoPsjpNA?autoplay=1&mute=1&controls=0&modestbranding=1&rel=0&playsinline=1&loop=1&playlist=oKwaoPsjpNA',
                    'css' => [
                        'video_bg' => [
                            'position' => 'relative',
                            'width' => '100%',
                            'height' => '100vh',
                            'overflow' => 'hidden',
                        ],
                        'iframe' => [
                            'position' => 'absolute',
                            'top' => '50%',
                            'left' => '50%',
                            'width' => '177.78vh',
                            'height' => '56.25vw',
                            'min-width' => '100%',
                            'min-height' => '100%',
                            'transform' => 'translate(-50%, -50%)',
                            'pointer-events' => 'none',
                        ],
                        'overlay' => [
                            'background-color' => 'rgba(0, 0, 0, 0.5)',
                            'position' => 'absolute',
                            'top' => '0',
                            'left' => '0',
                            'width' => '100%',
                            'height' => '100%',
                            'z-index' => '1',
                        ],
                    ],
                ],
            ],
        ],
        [
            'type' => 'deka_manifesto',
            'props' => [
                'index' => '— 01',
                'title' => 'Manifesto',
                'label' => 'On light, on certainty',
                'quote' => 'We believe the highest form of care is the one the patient never feels arrive. A laser, held in a steady hand, becomes something closer to **intention** — a quieter procedure, a cleaner margin, a shorter recovery. This is the clinical language DEKA has spent a generation perfecting.',
                'columns' => [
                    [
                        'h' => 'Built in Florence',
                        'p' => 'Every DEKA system is engineered, assembled, and calibrated by hand in our atelier outside Florence — the same workshop that has been shaping medical lasers since 1981.',
                    ],
                    [
                        'h' => 'Evidence, not adjectives',
                        'p' => 'More than 400 peer-reviewed papers inform our wavelengths, pulse shapes, and energy deliveries. We engineer to the paper, not the brochure.',
                    ],
                    [
                        'h' => 'A partner to the practice',
                        'p' => 'Our clinical team integrates with yours: training, protocols, tissue-specific libraries, and ongoing education — so the instrument pays itself forward from day one.',
                    ],
                ],
            ],
        ],
        [
            'type' => 'deka_capabilities',
            'props' => [
                'index' => '— 02',
                'title' => 'What DEKA Changes',
                'label' => 'Benefits · Innovation · Precision · Outcomes',
                'heading' => 'Four instruments of **clinical certainty**.',
                'text' => 'Every DEKA platform is organised around the same quiet promise — that the right wavelength, delivered with the right discipline, changes what dentistry feels like. Here is how that promise shows up, chairside.',
                'cards' => [
                    [
                        'num' => '01',
                        'kicker' => 'Benefit',
                        'h' => 'A calmer chair, a faster morning.',
                        'p' => 'Near-silent procedures. Less bleeding, fewer sutures, meaningfully shorter recoveries — patients leave comfortable, and they remember it.',
                    ],
                    [
                        'num' => '02',
                        'kicker' => 'Innovation',
                        'h' => 'Pulse architectures, perfected.',
                        'p' => 'Proprietary Pulsed Solid State™ and QSP™ emissions give clinicians expressive control over energy — tissue-specific, not one-size.',
                    ],
                    [
                        'num' => '03',
                        'kicker' => 'Precision',
                        'h' => 'A steadier hand, engineered in.',
                        'p' => 'Sub-micron delivery, active thermal management, and adaptive feedback — the instrument corrects before you notice the correction.',
                    ],
                    [
                        'num' => '04',
                        'kicker' => 'Outcome',
                        'h' => 'Results your patients refer.',
                        'p' => 'Predictable margins, cleaner biopsy sites, documented healing curves — and a waiting room that fills itself, because the chair speaks for you.',
                    ],
                ],
            ],
        ],
        [
            'type' => 'deka_lineup',
            'props' => [
                'index' => '— 03',
                'title' => 'The Collection',
                'label' => 'Three instruments, one standard',
                'products' => [
                    [
                        'image' => 'product_us20d',
                        'image_alt' => 'DEKA US-20D CO2 laser',
                        'tag' => 'US-20D',
                        'caption_l' => 'CO₂ · 10,600 nm',
                        'caption_r' => 'Compact',
                        'sm' => 'CO₂ · 10,600 nm',
                        'name' => 'US-20D',
                        'description' => 'The compact CO₂ instrument. An articulated arm, a mobile chassis, and the cleanest soft-tissue incision in the operatory — ready to move chair-to-chair.',
                        'meta_l' => 'Soft Tissue · CO₂',
                        'url' => '/shop/us-20d/',
                    ],
                    [
                        'image' => 'product_smartxide',
                        'image_alt' => 'DEKA SmartXide Ultraspeed 2 CO2 laser',
                        'tag' => 'SmartXide²',
                        'caption_l' => 'CO₂ · Pulse Shape Design',
                        'caption_r' => 'Flagship',
                        'sm' => 'CO₂ · PSD™',
                        'name' => 'SmartXide Ultraspeed 2',
                        'description' => 'The surgical flagship. Proprietary Pulse Shape Design delivers energy the tissue doesn\'t feel arrive — and a healing curve your patients will describe for you.',
                        'meta_l' => 'Surgical · CO₂',
                        'url' => '/shop/smartxide-ultraspeed2/',
                    ],
                    [
                        'image' => 'product_smartperio',
                        'image_alt' => 'DEKA SmartPerio Nd:YAG laser',
                        'tag' => 'SmartPerio',
                        'caption_l' => 'Nd:YAG · 1064 nm',
                        'caption_r' => 'Periodontal',
                        'sm' => 'Nd:YAG · 1064 nm',
                        'name' => 'SmartPerio',
                        'description' => 'The periodontal specialist. A pulsed Nd:YAG beam that reaches depth, sterilises pockets, and leaves the soft tissue above exactly as you found it.',
                        'meta_l' => 'Perio · Endo',
                        'url' => '/shop/smartperio/',
                    ],
                ],
            ],
        ],
        [
            'type' => 'deka_flagship',
            'props' => [
                'index' => '— 04',
                'title' => 'SmartPerio',
                'label' => 'Pulsed Nd:YAG · Periodontal specialist',
                'visual_label' => 'DEKA · SMARTPERIO Nd:YAG',
                'visual_caption' => 'DEKA · Florence',
                'ticker_left' => 'λ · 1064 nm',
                'ticker_right' => 'Made in Florence',
                'image' => 'product_smartperio',
                'image_alt' => 'DEKA SmartPerio Nd:YAG laser',
                'heading' => 'SmartPerio.
The **periodontal**
standard.',
                'lede' => 'A pulsed Nd:YAG instrument built for the pocket, the furcation, and the quiet decisions that define a periodontal practice — sterilising depth without surrendering the soft tissue above.',
                'specs' => [
                    [
                        'k' => 'Wavelength',
                        'v' => '1064',
                        'sup' => 'nm',
                    ],
                    [
                        'k' => 'Peak power',
                        'v' => '7',
                        'sup' => 'W',
                    ],
                    [
                        'k' => 'Pulse',
                        'v' => 'Free-running · Pulsed',
                    ],
                    [
                        'k' => 'Delivery',
                        'v' => 'Fiber · 300 µm',
                    ],
                ],
                'primary_cta' => [
                    'label' => 'Schedule a Private Demo',
                    'url' => '#final',
                ],
                'secondary_cta' => [
                    'label' => 'Download the Clinical Dossier',
                    'url' => '#',
                ],
            ],
        ],
        [
            'type' => 'deka_showcase',
            'props' => [
                'index' => '— 05.01',
                'title' => 'US-20D CO₂',
                'label' => 'The compact surgical standard',
                'dark' => false,
                'flip' => false,
                'visual_label' => 'DEKA · US-20D',
                'ticker_left' => 'λ · 10,600 nm',
                'ticker_right' => 'Articulated arm',
                'image' => 'product_us20d',
                'image_alt' => 'DEKA US-20D CO2 dental laser',
                'kicker' => 'The compact instrument',
                'heading' => 'A **CO₂ workhorse**,
refined to the millimetre.',
                'lede' => 'Compact enough to move between operatories, serious enough to carry the surgical day. The US-20D is the DEKA most dental practices meet first — and keep for life.',
                'specs' => [
                    [
                        'k' => 'Wavelength',
                        'v' => '10,600',
                        'sup' => 'nm',
                    ],
                    [
                        'k' => 'Max power',
                        'v' => '20',
                        'sup' => 'W',
                    ],
                    [
                        'k' => 'Delivery',
                        'v' => '7-joint arm',
                    ],
                    [
                        'k' => 'Modes',
                        'v' => 'CW · Pulsed · Super-Pulsed',
                    ],
                ],
                'primary_cta' => [
                    'label' => 'Request the US-20D Dossier',
                    'url' => '#final',
                ],
                'secondary_cta' => [
                    'label' => 'See indications',
                    'url' => '#',
                ],
            ],
        ],
        [
            'type' => 'deka_showcase',
            'props' => [
                'index' => '— 05.02',
                'title' => 'SmartXide Ultraspeed 2',
                'label' => 'Pulse Shape Design CO₂',
                'dark' => true,
                'flip' => true,
                'visual_label' => 'DEKA · SMARTXIDE²',
                'ticker_left' => 'λ · 10,600 nm · PSD™',
                'ticker_right' => 'Flagship',
                'image' => 'https://test-theme-deka.local/wp-content/uploads/2026/04/DEKA-SX2.webp',
                'image_alt' => 'DEKA SmartXide Ultraspeed 2 CO2 dental laser',
                'kicker' => 'The surgical flagship',
                'heading' => 'Pulse Shape Design.
A CO₂ **you can\'t feel**
arrive.',
                'lede' => 'The SmartXide Ultraspeed 2 is our proprietary PSD™ CO₂ platform. Energy shaped to the tissue, not the tissue shaped to the beam — with thermal confinement so disciplined the procedure ends before the patient notices it began.',
                'specs' => [
                    [
                        'k' => 'Wavelength',
                        'v' => '10,600',
                        'sup' => 'nm',
                    ],
                    [
                        'k' => 'Max power',
                        'v' => '30',
                        'sup' => 'W',
                    ],
                    [
                        'k' => 'Signature',
                        'v' => 'PSD™ · SmartPulse™',
                    ],
                    [
                        'k' => 'Indications',
                        'v' => 'Surgical · Peri-implant',
                    ],
                ],
                'primary_cta' => [
                    'label' => 'Schedule a SX² Demo',
                    'url' => '#final',
                ],
                'secondary_cta' => [
                    'label' => 'Download the PSD™ whitepaper',
                    'url' => '#',
                ],
            ],
        ],
        [
            'type' => 'deka_outcomes',
            'props' => [
                'index' => '— 06',
                'title' => 'Evidence',
                'label' => 'Measured, not marketed',
                'heading' => 'The quiet math of a **superior** procedure.',
                'text' => 'Every number below comes from peer-reviewed clinical literature published between 2016 and 2025. If a claim isn\'t documented, it isn\'t printed.',
                'metrics' => [
                    [
                        'num' => '–62',
                        'sup' => '%',
                        'label' => 'Reduction in post-operative discomfort vs. conventional modality',
                    ],
                    [
                        'num' => '2.4',
                        'sup' => '×',
                        'label' => 'Faster soft-tissue healing observed at 14 days',
                    ],
                    [
                        'num' => '0.98',
                        'label' => 'Clinician reliability score across 1,200+ SmartXide cases',
                    ],
                    [
                        'num' => '+34',
                        'sup' => '%',
                        'label' => 'Practice case acceptance when laser is offered first',
                    ],
                ],
            ],
        ],
        [
            'type' => 'deka_voices',
            'props' => [
                'index' => '— 07',
                'title' => 'Clinicians',
                'label' => 'In their own words',
                'voices' => [
                    [
                        'q' => 'SmartXide changed how I schedule. Procedures I used to staff for an hour now close in twenty minutes, and the <em>recoveries speak for themselves</em>.',
                        'n' => 'Dr. Elena Marchetti, DDS',
                        't' => 'Studio Marchetti · Milan',
                    ],
                    [
                        'q' => 'The Nd:YAG pulse shape is unlike anything in my operatory. It is an instrument that <em>behaves the way you think</em> — which is the only compliment that matters.',
                        'n' => 'Dr. Hiroshi Tanaka, DMD, PhD',
                        't' => 'Tokyo Advanced Periodontics',
                    ],
                    [
                        'q' => 'The SmartXide is the quietest surgical decision in my practice. Patients ask if we\'ve <em>already started</em> — we\'ve already finished.',
                        'n' => 'Dr. Sofia Reyes, DDS, MS',
                        't' => 'Reyes Oral Surgery · Madrid',
                    ],
                    [
                        'q' => 'I\'ve placed every major laser in my thirty years. DEKA is the one I put in my own mother\'s mouth.',
                        'n' => 'Dr. Margaret Chen, DDS, FACD',
                        't' => 'Chen Dental Arts · San Francisco',
                    ],
                ],
            ],
        ],
        [
            'type' => 'deka_trust',
            'props' => [
                'label' => 'Trusted by teaching institutions and top-quartile practices across 54 countries.',
                'logos' => [
                    [
                        'name' => 'Università di Firenze',
                    ],
                    [
                        'name' => 'Karolinska',
                        'mono' => true,
                    ],
                    [
                        'name' => 'King\'s College London',
                    ],
                    [
                        'name' => 'UCSF Dental',
                        'mono' => true,
                    ],
                    [
                        'name' => 'Tokyo Medical',
                    ],
                    [
                        'name' => 'USC Ostrow',
                        'mono' => true,
                    ],
                ],
            ],
        ],
        [
            'type' => 'deka_final',
            'props' => [
                'eyebrow' => '— A private conversation',
                'heading' => 'The instrument you\'ve been waiting for
is waiting for **you**.',
                'text' => 'We don\'t run a showroom. We schedule a private demonstration in your operatory, with a clinical specialist who has placed hundreds of systems like yours. Quiet, unhurried, and entirely on your terms.',
                'primary_cta' => [
                    'label' => 'Schedule a Private Demo',
                    'url' => '/contact/',
                ],
                'secondary_cta' => [
                    'label' => 'Speak with a Clinical Advisor',
                    'url' => '/contact/',
                ],
            ],
        ],
    ],
];
