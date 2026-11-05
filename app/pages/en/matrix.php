<?php
// Matrix – mxchat.cz page (English).

return [
    'title'       => 'Matrix — community chat mxchat.cz | OSCloud',
    'description' => 'Community chat on the open, decentralised Matrix protocol. No ads, no tracking, and you can talk to people on other Matrix servers too.',
    'nav'         => 'community',

    'hero' => [
        'breadcrumb' => [['Community', url('home') . '#komunita'], ['Matrix', null]],
        'eyebrow'    => 'Community chat',
        'title'      => 'Matrix — mxchat.cz',
        'lead'       => 'Community chat on the open, decentralised Matrix protocol.',
        'paragraphs' => ['No ads, no tracking, and you can talk **to people on other Matrix servers too**.'],
        'buttons'    => [['Join the community', LINKS['matrix']], ['Open chat', LINKS['mxchat']]],
        'emoji'      => '💬',
        'chips'      => ['Encrypted', 'Federated', 'Element', 'FluffyChat'],
    ],

    'blocks' => [
        [
            'type'       => 'text',
            'heading'    => 'What is Matrix',
            'paragraphs' => ['Matrix is an open chat protocol, **a bit like email**: you have an account on one server and still talk to people on any other. Our server is mxchat.cz, so your address will look like **@name:mxchat.cz**.'],
        ],
        [
            'type'  => 'columns',
            'bg'    => 'ice',
            'items' => [
                [
                    'heading'    => 'How to get an account',
                    'paragraphs' => ['Mxchat is a community Matrix server run by OSCloud. Registration is not closed but invite-only: it needs a **short approval by an admin**. This protects against spambots and keeps the community healthy.'],
                    'steps'      => [
                        'Fill in the [Join us form](' . url('join') . '?sluzba=matrix), choose Matrix chat and write the nickname you want and briefly why you want an account in the note.',
                        'We usually reply within 24 hours.',
                        'Once approved, we send you a registration token. **The token works for 5 people**, so you can invite friends or family.',
                        'On [chat.mxchat.cz](' . LINKS['mxchat'] . ') click Create Account, fill in your details and paste the token.',
                    ],
                    'buttons'    => [['Request an account', url('join') . '?sluzba=matrix']],
                ],
                [
                    'heading'    => 'Alternative: log in with OSCloud',
                    'paragraphs' => ['If you already have an OSCloud account, you do not need a token. On [chat.mxchat.cz](' . LINKS['mxchat'] . ') click **Continue with OSCloud** and log in with your OSCloud account.'],
                    'note'       => '**Why not open registration?** Open registrations on Matrix servers attract spambots and accounts abused for spreading unwanted content. Approval lets us keep the server off federation ban lists and protect the community from harassment.',
                ],
            ],
        ],
        [
            'type'       => 'text',
            'heading'    => 'Apps',
            'paragraphs' => [
                'The web is enough, but an app is more convenient on phone and desktop. Any Matrix client works, e.g. [Element](https://element.io/download) or [FluffyChat](https://fluffychat.im/). When logging in, enter **https://mxchat.cz** as the homeserver.',
                'OSCloud support runs on Matrix, so you can reach us right there. For anything official, use [info@oscloud.cz](mailto:info@oscloud.cz).',
            ],
        ],
        [
            'type'   => 'facts',
            'bg'     => 'ice',
            'groups' => [
                ['Links', [
                    ['mxchat.cz website', 'web.mxchat.cz', 'https://web.mxchat.cz'],
                    ['Chat', 'chat.mxchat.cz', LINKS['mxchat']],
                    ['Server', 'mxchat.cz'],
                    ['Documentation', 'docs.oscloud.cz', LINKS['docs']],
                ]],
            ],
        ],
        [
            'type'       => 'closing',
            'heading'    => 'Come and join us.',
            'paragraphs' => ['The #oscloudcz room is for support, news and just chatting.'],
            'buttons'    => [['Join the community', LINKS['matrix']], ['Request an account', url('join') . '?sluzba=matrix']],
        ],
    ],
];
