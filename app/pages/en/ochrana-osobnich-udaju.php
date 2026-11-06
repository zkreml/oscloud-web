<?php
// Courtesy translation of app/pages/ochrana-osobnich-udaju.php. The Czech version is binding.
// Keep the structure (sections, order) identical to the Czech file: articles are cross-referenced by number.

return [
    'template'    => 'legal',
    'title'       => 'Privacy Policy — OSCloud',
    'description' => 'How OSCloud, z. s. processes personal data of its service users and website visitors (courtesy translation, the Czech version is binding).',
    'nav'         => null,

    'heading'   => 'Privacy Policy',
    'lead'      => 'What personal data OSCloud processes, why, for how long, and what rights data subjects have.',
    'effective' => '4 November 2026',

    'sections' => [
        [
            'title' => 'Data controller',
            'body'  => [
                ['list' => [
                    '**Controller:** OSCloud, z. s., company ID 29991145, Pionýrů 1332, 356 01 Sokolov, Czech Republic',
                    '**Contact for personal data matters:** [info@oscloud.cz](mailto:info@oscloud.cz)',
                ]],
                'If a customer stores personal data of third parties (members, employees, clients) in the services, the customer is their controller and OSCloud is the processor. The relationship is governed by the [data processing agreement](' . url('dpa') . ').',
            ],
        ],
        [
            'title' => 'Purposes, data and retention period',
            'body'  => [
                ['table' => [
                    'head' => ['Purpose', 'Data', 'Legal basis', 'Retention period'],
                    'rows' => [
                        ['Handling a request from the form', 'name or nickname, e-mail, chosen service and plan, message, record of agreement with the terms; for paid services first and last name and invoicing address; for associations and companies name, company ID, address, contact person', 'negotiating a contract (Art. 6(1)(b) GDPR)', 'until the request is handled, at most 6 months if no contract is concluded'],
                        ['Providing the services (account, e-mail, content stored by the user)', 'login and contact data, content the user puts into the service', 'performance of a contract (Art. 6(1)(b))', 'for the duration of the contract; after it ends according to article 5 of the terms'],
                        ['Invoicing and accounting', 'first and last name or name, address, company ID (for associations and companies), payment data; as a party to an accounting transaction, the customer must be identified on the invoice', 'legal obligation (Art. 6(1)(c))', 'for the period set by law (usually several years)'],
                        ['Support and communication', 'messages, e-mails and tickets in the helpdesk', 'performance of a contract, legitimate interest in proper support and in defending legal claims (Art. 6(1)(b), (f))', 'for the duration of the contract and at most 3 years after it ends (limitation period)'],
                        ['Security and operation', 'IP address, browser and device type, time of access (server logs)', 'legitimate interest in security and stability (Art. 6(1)(f))', 'at most 14 days, then automatically deleted'],
                        ['Website traffic statistics', 'anonymous visit counts without cookies and without personal identifiers (our own Umami instance on our server)', 'legitimate interest in improving the website (Art. 6(1)(f))', 'at most 12 months'],
                    ],
                ]],
                'The data is not used for automated decision-making, profiling or advertising. We do not collect phone numbers.',
            ],
        ],
        [
            'title' => 'Recipients of data',
            'body'  => [
                ['list' => [
                    '**Hetzner Online GmbH** (Germany): hosting of servers and backups, processor.',
                    '**Contabo GmbH** (Germany): hosting of the server with Matrix chat (mxchat.cz), processor. The server is in Munich.',
                    '**netcup GmbH** (Germany): hosting of the FitPub service (makni.cz), processor. The data center is in Nuremberg.',
                    '**Stripe** (Stripe Payments Europe, Ltd., Ireland): processing of card payments for Ente Photos. The provider neither sees nor stores card numbers. Stripe may transfer data to the USA, for which it relies on certification under the EU-U.S. Data Privacy Framework and standard contractual clauses. More information: [Stripe privacy policy](https://stripe.com/privacy).',
                    '**Bank**: payments by bank transfer. The association keeps its accounts itself, without an external processor.',
                    'Public authorities, where required by law.',
                ]],
                'The provider runs the helpdesk, e-mail and other tools on its own servers. Data is not passed to other companies for marketing. The other processors of the providers named above are listed in the [data processing agreement](' . url('dpa') . ').',
            ],
        ],
        [
            'title' => 'Transfers outside the EU',
            'body'  => [
                'The servers are located in Germany (Hetzner, Contabo, netcup). Personal data is not transferred to third countries, except for the processing of payments by the intermediary named in article 3.',
            ],
        ],
        [
            'title' => 'Fediverse and chat',
            'body'  => [
                'Public posts and messages in federated services (Mastodon, PeerTube, Pixelfed, Matrix) are transferred to the servers of other operators. After deletion on the OSCloud server they may not be deleted at third parties that OSCloud does not control.',
            ],
        ],
        [
            'title' => 'Security',
            'body'  => [
                'Data transfer is protected by HTTPS, only authorised persons have access to the servers, and backups are stored on a separate storage. Photos in Ente Photos are end-to-end encrypted and the provider has no access to them.',
            ],
        ],
        [
            'title' => 'Cookies',
            'body'  => [
                'The website oscloud.cz does not use cookies or third-party tools, so it does not require cookie consent. Traffic statistics are provided by Umami, which runs on our server, measures anonymously and does not use cookies.',
                'Individual services (for example Nextcloud, Mastodon or Matrix) use only technical cookies of login sessions that are necessary for their operation. We do not use any advertising or tracking cookies. We do not send data about the use of the website or services to third-party advertising or analytics services (for example Google or Amazon). Data is processed only by tools on our servers and the providers named in the section on processors (hosting at Hetzner, payment processing for Ente Photos via Stripe).',
            ],
        ],
        [
            'title' => 'Rights of data subjects',
            'body'  => [
                'A data subject has the right of access to the data, to rectification, erasure, restriction of processing, data portability, and the right to object to processing based on a legitimate interest. Consent, if given, can be withdrawn at any time. Requests are submitted by e-mail to [info@oscloud.cz](mailto:info@oscloud.cz) and are handled within one month.',
                'A data subject also has the right to lodge a complaint with the supervisory authority: Office for Personal Data Protection (Úřad pro ochranu osobních údajů), Pplk. Sochora 27, 170 00 Prague 7, Czech Republic, [www.uoou.gov.cz](https://www.uoou.gov.cz).',
            ],
        ],
        [
            'title' => 'Ente Photos',
            'body'  => [
                'Photos and files in Ente Photos are encrypted on the user’s device before they are uploaded. The provider sees only the amount of storage used and the encrypted metadata necessary for operation, and therefore cannot provide access to the content or transfer it. The user downloads their data themselves in the app, using the password and the recovery key. On request, the provider can delete the account and all encrypted data. The servers are in Germany (Hetzner, Falkenstein).',
            ],
        ],
        [
            'title' => 'Password manager (Vaultwarden)',
            'body'  => [
                'The contents of the vault at pass.oscloud.cz (passwords, notes, files) are encrypted on the user’s device before being sent to the server. The provider has no access to it and cannot restore it if the master password is lost. The following is processed: the e-mail address, the hash of the master password (not the password itself), the time of registration and login, the IP address in server logs (at most 14 days) and the encrypted vault data. The legal basis is performance of the contract for the provision of the service (Art. 6(1)(b) GDPR). The data is kept for as long as the account exists. After it is cancelled, the data is deleted and removed from backups gradually, according to the backup rotation. The servers are in Germany (Hetzner).',
            ],
        ],
        [
            'title' => 'Changes to this policy',
            'body'  => [
                'This policy may change. The current version is always on this page and material changes are announced on the website. Effective from: 4 November 2026.',
            ],
        ],
    ],
];
