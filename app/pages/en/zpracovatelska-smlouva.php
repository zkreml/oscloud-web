<?php
// Courtesy translation of app/pages/zpracovatelska-smlouva.php. The Czech version is binding.
// Keep the structure (sections, order) identical to the Czech file: articles are cross-referenced by number.

return [
    'template'    => 'legal',
    'title'       => 'Data Processing Agreement — OSCloud',
    'description' => 'Personal data processing agreement (Art. 28 GDPR) for customers of OSCloud, z. s. (courtesy translation, the Czech version is binding).',
    'nav'         => null,

    'heading'   => 'Data Processing Agreement',
    'lead'      => 'An agreement under Art. 28 GDPR between the customer (controller) and OSCloud, z. s. (processor). It is concluded together with the order for a paid service if the customer stores personal data of third parties.',
    'effective' => '18 October 2026',

    'sections' => [
        [
            'title' => 'Parties',
            'body'  => [
                '**Controller:** the customer according to the order (name, company ID and address are stated in the order and the confirmation). **Processor:** OSCloud, z. s., company ID 29991145, Pionýrů 1332, 356 01 Sokolov, Czech Republic.',
            ],
        ],
        [
            'title' => 'Subject matter and duration of processing',
            'body'  => [
                'The processor provides the controller with the service according to the order (for example Nextcloud, forum, web hosting or e-mail) and within it processes the personal data that the controller puts into the service. The processing lasts for the duration of the service contract.',
            ],
        ],
        [
            'title' => 'Nature, purpose and scope',
            'body'  => [
                ['list' => [
                    '**Nature of processing:** storing, backing up and making data available in the service.',
                    '**Purpose:** providing the ordered service to the controller.',
                    '**Types of data:** data contained in files, messages and content that the controller puts into the service; identification and contact data of team members.',
                    '**Categories of data subjects:** members, employees, clients and other persons whose data the controller puts into the service.',
                ]],
            ],
        ],
        [
            'title' => 'Obligations of the processor',
            'body'  => [
                ['list' => [
                    'To process data only on the documented instructions of the controller, which include this agreement and the order.',
                    'To ensure the confidentiality of persons who have access to the data.',
                    'To take appropriate technical and organisational measures: encrypted transfer (HTTPS), access limited to authorised persons, backups on a separate storage and regular updates.',
                    'To engage other processors only under the conditions of article 5.',
                    'To assist the controller in handling requests of data subjects and in fulfilling obligations under the GDPR, to a reasonable extent and taking into account the nature of the processing.',
                    'To notify the controller of a personal data breach without undue delay, at the latest within 48 hours of becoming aware of it.',
                    'After the contract ends, to delete the data according to article 5 of the terms (after the download period), or to return it to the controller, at the controller’s choice.',
                    'To provide the controller with the information necessary to demonstrate compliance and to allow an audit, on request, at an agreed time and in a way that does not endanger the operation or security of other customers.',
                ]],
            ],
        ],
        [
            'title' => 'Other processors',
            'body'  => [
                'The controller gives general authorisation for the engagement of other processors. As of the date of this agreement, these are:',
                'The processor informs the controller of a change to the list by e-mail at least 30 days in advance. The controller may object to the change and, if the parties do not agree, may terminate the service contract.',
            ],
        ],
        [
            'title' => 'Obligations of the controller',
            'body'  => [
                'The controller is responsible for the lawfulness of the processing and for having a legal basis for putting the data into the service and for having fulfilled the information duties towards data subjects. The controller must not put into the service data that the processor is not equipped to process, without prior agreement (in particular special categories of personal data).',
            ],
        ],
        [
            'title' => 'Final provisions',
            'body'  => [
                'This agreement is an integral part of the service contract. In case of conflict, this agreement prevails as regards the processing of personal data. The agreement is governed by the law of the Czech Republic. Contact for personal data matters: [info@oscloud.cz](mailto:info@oscloud.cz). Effective from: 18 October 2026.',
            ],
        ],
    ],
];
