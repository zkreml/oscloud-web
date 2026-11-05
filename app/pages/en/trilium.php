<?php
// Trilium Next page (English).

$p = TRILIUM_PRICES;

return [
    'title'       => 'Trilium Next — your own notes and Markdown | OSCloud',
    'description' => 'Your own notes in one place: tree structure, Markdown, access from anywhere. Your own separate instance from 65 CZK a month.',
    'nav'         => 'services',

    'hero' => [
        'breadcrumb' => [['Pricing', url('pricing')], ['Trilium Next', null]],
        'eyebrow'    => 'Your own notes',
        'title'      => 'Trilium Next',
        'lead'       => 'Your own notes in one place: tree structure, Markdown, access from anywhere.',
        'paragraphs' => ['Every customer has **their own separate instance**.'],
        'price'      => ['from', money($p['monthly']), '/ month'],
        'buttons'    => [['Order', url('join') . '?typ=trilium&period=monthly'], ['Documentation', doc('triliumnext')]],
        'emoji'      => '📝',
        'chips'      => ['Tree', 'Markdown', 'Encryption', '5 GB'],
    ],

    'blocks' => [
        [
            'type'       => 'intro',
            'paragraphs' => [
                'Trilium Next is an open source tool for hierarchical notes and a personal knowledge base.',
                'It is a web application with a desktop client too. Notes can be text, Markdown, code, tables or diagrams, and you organise them in a tree.',
            ],
        ],
        [
            'type'    => 'cards',
            'title'   => 'What it does',
            'columns' => 3,
            'items'   => [
                ['icon' => 'tasks', 'title' => 'Tree structure', 'text' => 'One note can live in several places (cloning).'],
                ['icon' => 'shield', 'title' => 'Encryption', 'text' => 'Encrypt selected notes.'],
                ['icon' => 'sync', 'title' => 'Versioning', 'text' => 'Automatic, so you can go back to an older version of a note.'],
                ['icon' => 'share', 'title' => 'Relations & search', 'text' => 'Relation maps between notes and full-text search.'],
                ['icon' => 'code', 'title' => 'Markdown & code', 'text' => 'Markdown, code, tables, diagrams and formulas. JavaScript scripting for power users.'],
                ['icon' => 'cloud', 'title' => 'Web & desktop', 'text' => 'Sync between the web and the desktop client.'],
            ],
        ],
        [
            'type'    => 'table',
            'bg'      => 'ice',
            'id'      => 'cenik',
            'title'   => 'Price',
            'text'    => 'Includes your own instance with **5 GB of storage**, HTTPS and regular backups.',
            'caption' => 'Trilium Next price',
            'narrow'  => true,
            'head'    => ['Plan', 'Price', ''],
            'rows'    => [
                ['Basic', money($p['monthly']) . ' / month', ['Order', url('join') . '?typ=trilium&period=monthly']],
                ['Yearly', money($p['yearly']) . ' / year', ['Order', url('join') . '?typ=trilium&period=yearly']],
            ],
            'notes'   => ['Custom domain and more storage individually. OSCloud, z. s. is not a VAT payer, prices are final.'],
        ],
        [
            'type'    => 'table',
            'title'   => 'How it differs from Notes in Nextcloud',
            'caption' => 'Notes in Nextcloud compared with Trilium Next',
            'head'    => ['', 'Notes in Nextcloud', 'Trilium Next'],
            'rows'    => [
                ['Organisation', 'List of notes and folders', 'Tree, cloned notes, relations'],
                ['For whom', 'Quick notes', 'Larger knowledge base and archive'],
                ['Price', 'Included in Nextcloud', 'Separate instance from ' . money($p['monthly']) . ' a month'],
            ],
            'notes'   => ['If simple notes are enough, [Nextcloud](' . url('nextcloud') . ') will do. Trilium is for when you have lots of notes and want to see how they connect.'],
        ],
        [
            'type'  => 'faq',
            'bg'    => 'ice',
            'title' => 'FAQ',
            'items' => [
                ['How do I order?', 'Fill in the [join request](' . url('join') . '?typ=trilium), choose Trilium Next and monthly or yearly billing. We set up instances by hand and will email you.'],
                ['Can I have my own domain?', 'Yes, e.g. notes.mydomain.com. This is arranged individually after ordering.'],
                ['What if I need more than 5 GB?', 'Write to us and we will work it out individually.'],
                ['Where is the guide?', 'The [Trilium Next documentation](' . doc('triliumnext') . ') describes features, compares it with other tools and covers setup.'],
                ['Are my notes safe?', 'Every customer has their own separate instance and we back up the data. You can also encrypt sensitive notes in Trilium. It is wise to back up important data outside OSCloud too.'],
            ],
        ],
        [
            'type'    => 'closing',
            'heading' => 'Want your own Trilium?',
            'buttons' => [['I want Trilium Next', url('join') . '?typ=trilium&period=monthly'], ['Full pricing', url('pricing')]],
        ],
    ],
];
