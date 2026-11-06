<?php
// Courtesy translation of app/pages/podminky.php. The Czech version is binding.
// Keep the structure (sections, order) identical to the Czech file: articles are cross-referenced by number.
// Paragraph = string, list = ['list' => [...]], **bold**, [link](address).

return [
    'template'    => 'legal',
    'title'       => 'Terms and Conditions — OSCloud',
    'description' => 'Terms and conditions for all services of OSCloud, z. s. (courtesy translation, the Czech version is binding).',
    'nav'         => null,

    'heading'   => 'Terms and Conditions',
    'lead'      => 'These terms apply to all services of OSCloud, z. s. The current version is always the one on this page.',
    'effective' => '18 October 2026',
    'pdf'       => 'oscloud-terms-en.pdf',

    'sections' => [
        [
            'title' => 'Provider and definitions',
            'body'  => [
                ['list' => [
                    '**Provider:** OSCloud, z. s. (the “provider”)',
                    '**Company ID / VAT ID:** 29991145 / CZ29991145 (the provider is not a VAT payer)',
                    '**Registered office:** Pionýrů 1332, 356 01 Sokolov, Czech Republic',
                    '**Register:** register of associations, Regional Court in Plzeň, section L, file 11449',
                    '**Contact:** [info@oscloud.cz](mailto:info@oscloud.cz), [helpdesk.oscloud.cz](https://helpdesk.oscloud.cz/help/3271740098)',
                ]],
                'Terms used in these conditions:',
                ['list' => [
                    '**Service** means any service operated by the provider under article 2.',
                    '**User** means anyone who uses the services.',
                    '**Customer** means a user who has concluded a contract for a paid service with the provider.',
                    '**Consumer** means a natural person who concludes a contract outside their business or other gainful activity.',
                    '**Business customer** means a customer who is not a consumer, in particular an association, a company or a self-employed person.',
                ]],
            ],
        ],
        [
            'title' => 'Services',
            'body'  => [
                'The provider operates in particular the following services: Nextcloud, Ente Photos, Matrix chat (mxchat.cz), fediverse services (Mastodon, PeerTube, Pixelfed, FitPub), community tools (CryptPad, HedgeDoc, Trilium, Vaultwarden, SearXNG, PrivateBin, FreshRSS, Miniflux, Wallabag, Linkwarden, MiroTalk, ntfy), a discussion forum, a wiki for communities, web hosting (static pages, LAMP, managed WordPress) and an e-mail mailbox as an add-on to web hosting. The current overview and prices are on the [home page](' . url('home') . '#sluzby) and in the [pricing](' . url('pricing') . ').',
                'Some services are available only after registering with OSCloud (for example PrivateBin). Free services are provided with no entitlement to their continuation and without any availability guarantee. The provider may change or end them, and will announce this in advance in the way set out in article 15.',
            ],
        ],
        [
            'title' => 'Conclusion of the contract',
            'body'  => [
                ['list' => [
                    'A paid service is ordered through the form on the website. The data can be corrected before sending.',
                    'The contract is concluded when the provider confirms the order by e-mail. The provider may refuse an order.',
                    'As of the confirmation date, the customer is sent the text of these conditions in durable form (a link or an e-mail attachment).',
                    'The contract is concluded in Czech. The provider keeps order data for the period stated in the [privacy policy](' . url('privacy') . ').',
                    'Free services are made available through registration or an invitation. By registering, the user agrees to comply with these conditions.',
                ]],
            ],
        ],
        [
            'title' => 'Price and payment',
            'body'  => [
                ['list' => [
                    'Prices are set by the pricing on the website valid on the day the order is confirmed. The provider is not a VAT payer, so prices are final.',
                    'An invoice is issued for every paid service and sent by e-mail. For business customers it states the company ID and the data from the order.',
                    'Payment is made in advance for the chosen period (month or year) by bank transfer to the account stated on the invoice, using the variable symbol. The invoice is due 14 days after issue.',
                    'The Ente Photos subscription is paid by card through the payment provider Stripe (see appendix A).',
                    'The provider announces a price change at least 30 days in advance. The customer may terminate the contract before the change takes effect.',
                ]],
            ],
        ],
        [
            'title' => 'Duration and termination',
            'body'  => [
                ['list' => [
                    'The contract is concluded for an indefinite period and is performed for the paid periods (month or year).',
                    'A change of plan, for example of storage size, takes effect at the start of the next period, or earlier by agreement.',
                    'The customer may terminate the contract at any time by e-mail. The termination takes effect at the end of the paid period. The price for the unused part of the period is not refunded unless the law provides otherwise (in particular in case of withdrawal under article 12).',
                    'The provider may terminate the contract with a notice period of 30 days. In case of a material breach of these conditions (articles 6 and 7) the provider may terminate it with immediate effect.',
                    'After the contract ends, the data can be downloaded for 14 days, then it is deleted. It is removed from backups gradually, according to the backup rotation.',
                    'After paid storage ends, the free limit of the service applies. If the data exceeds this limit, it must be reduced or downloaded before the end of the period. Data above the limit can then only be downloaded for 30 days and may be deleted afterwards.',
                ]],
            ],
        ],
        [
            'title' => 'Non-payment',
            'body'  => [
                ['list' => [
                    'After the due date, a reminder is sent to the customer by e-mail.',
                    'If the invoice is not paid within 14 days after the due date, the service is suspended. Access is restricted and the data is kept.',
                    'If the amount due is not paid within 30 days of suspension, the data is deleted unless the parties agree otherwise.',
                    'Until deletion, the service can be restored after payment.',
                ]],
            ],
        ],
        [
            'title' => 'Rules of use',
            'body'  => [
                'The services must not be used for the following activities:',
                ['list' => [
                    'storing, publishing or distributing unlawful content, in particular content depicting the sexual abuse of children, supporting terrorism and violence, or hatred towards groups of people,',
                    'distributing malicious code, phishing, fraud and attacks on other systems,',
                    'sending unsolicited or bulk messages (spam),',
                    'bypassing quotas and limits of the service, or abusing other people’s accounts,',
                    'infringing the rights of third parties, including copyright.',
                ]],
                'If a breach of these rules is suspected, the provider may block or remove an account, mailbox or content immediately, even without prior notice. Serious cases are reported to law enforcement authorities.',
                'For e-mail, a sending limit set by the provider applies (the value is stated in the order confirmation). Sending messages to a larger number of recipients without their consent is prohibited. If abuse or a compromise of a mailbox is suspected, sending is blocked immediately so that the reputation of the shared sending address of the other services is not damaged.',
                'Fediverse services and chat are in addition governed by the rules of the given instance, which may be stricter (see appendix B).',
            ],
        ],
        [
            'title' => 'Content, account and reporting',
            'body'  => [
                ['list' => [
                    'The user is responsible for the content they store or publish and for the security of their login credentials. A strong unique password and two-factor authentication are recommended.',
                    'The provider does not search or actively monitor users’ content. It reacts to notices and to breaches it detects.',
                    '**Reporting unlawful content:** by e-mail to [info@oscloud.cz](mailto:info@oscloud.cz). The notice should contain the address (URL) of the content, a description of the reason and a contact for the person reporting it. The provider assesses the notice and communicates the decision, including the reasons, to the persons concerned.',
                ]],
            ],
        ],
        [
            'title' => 'Availability, backups and liability',
            'body'  => [
                ['list' => [
                    'The provider operates the services with reasonable care. Planned outages are announced in advance whenever possible. A specific level of availability is not guaranteed unless it was expressly agreed.',
                    '**Server backups** are stored on a separate storage and serve to restore operations. They are not an archive and do not guarantee the restoration of individual files. File synchronisation is not a backup. The user is responsible for their own copies of important data. It is recommended to always keep a copy of important data outside OSCloud as well, for example on your own external drive.',
                    '**Support:** users of community services can use Matrix chat; customers can use e-mail and the helpdesk. For the business plan, the provider starts responding to a request within 24 hours on working days. This is a deadline for a response, not for a resolution.',
                    'The provider is liable for damage to the extent set by law. For business customers, liability is limited to the amount paid for the affected service in the last 12 months and compensation for lost profit is excluded, to the extent the law permits. The limitation of liability does not apply to harm caused intentionally or by gross negligence, nor to harm to the natural rights of a person. The statutory rights of consumers are not affected.',
                ]],
            ],
        ],
        [
            'title' => 'Teams and multiple users',
            'body'  => [
                ['list' => [
                    'Plans for associations and companies include an indicative number of users and shared storage. For a larger number of team members, contact support.',
                    'The Family plan is intended for a household and includes four Nextcloud users with shared storage. The storage is divided among the users and the plan is not intended for operating services for third parties.',
                    'The team is the responsibility of its leader (administrator), who adds members themselves. The customer is responsible for members complying with these conditions.',
                    'Every team member needs their own e-mail address. The Nextcloud account is created when the member first logs in.',
                ]],
            ],
        ],
        [
            'title' => 'Domain, web hosting and e-mail',
            'body'  => [
                ['list' => [
                    'A custom domain remains the property of the customer. The customer is responsible for its registration, renewal and for the DNS settings with their domain registrar. The exact DNS record values are sent to the customer after the order is approved.',
                    'Web hosting is provided according to the ordered plan as static pages (HTML, CSS, JavaScript), LAMP hosting (PHP and MySQL) or managed WordPress. The customer is responsible for the content of the website; the rules of articles 7 and 8 apply.',
                    'An e-mail mailbox is provided only as an add-on to web hosting, in the ordered size. Operation on a custom domain requires MX, SPF, DKIM and DMARC records.',
                    'For services with a custom domain, in particular Mastodon, the domain name cannot be changed after the instance is launched.',
                ]],
            ],
        ],
        [
            'title' => 'Consumers',
            'body'  => [
                ['list' => [
                    '**Withdrawal from the contract:** a consumer may withdraw from a contract concluded at a distance within 14 days of its conclusion without giving a reason. Withdrawal is notified by e-mail to [info@oscloud.cz](mailto:info@oscloud.cz); a model form is available on request.',
                    'If the consumer asked for the service to start before this period expired, on withdrawal they pay a proportionate part of the price for the time during which the service was provided.',
                    '**Complaints:** defects in the service are reported to [info@oscloud.cz](mailto:info@oscloud.cz). The provider resolves the complaint within 30 days. Rights from defective performance are governed by the Civil Code.',
                    '**Out-of-court dispute resolution:** the body designated for out-of-court resolution of consumer disputes is the Czech Trade Inspection Authority ([www.coi.cz](https://www.coi.cz)).',
                    'No provision of these conditions reduces the statutory rights of the consumer.',
                ]],
            ],
        ],
        [
            'title' => 'Business customers, associations and companies',
            'body'  => [
                ['list' => [
                    'The provisions of article 12 do not apply to business customers.',
                    'The invoice is issued to the customer’s company ID from the order.',
                    'If the customer stores personal data of third parties (for example members, employees, clients), the customer is their controller and the provider is the processor. The relationship is governed by the [data processing agreement](' . url('dpa') . '), which is concluded together with the order.',
                    'The support response time and the limitation of liability are set out in article 9.',
                ]],
            ],
        ],
        [
            'title' => 'Personal data',
            'body'  => [
                'The processing of personal data is described in the [privacy policy](' . url('privacy') . ').',
            ],
        ],
        [
            'title' => 'Changes to the conditions',
            'body'  => [
                'The provider may update these conditions. It publishes the new version on this page and informs customers by e-mail at least 30 days before it takes effect. The customer may terminate the contract before the change takes effect. The change does not affect an already paid period.',
            ],
        ],
        [
            'title' => 'Final provisions',
            'body'  => [
                'Contracts and these conditions are governed by the law of the Czech Republic. Contact: [info@oscloud.cz](mailto:info@oscloud.cz). These conditions take effect on 18 October 2026.',
            ],
        ],
        [
            'title' => 'Appendix A: Ente Photos (oscloud.photos)',
            'body'  => [
                ['list' => [
                    '**Encryption:** files are encrypted on the user’s device before they are uploaded to the server. The provider has no access to the content and cannot decrypt it. It sees only the amount of storage used and the encrypted metadata necessary for operation.',
                    '**The password and the recovery key** are the only way to access the data. If they are lost, the data cannot be recovered, not even by the provider. The user is responsible for keeping them safe, and it is advisable to have important data backed up outside the service as well.',
                    '**The subscription** is purchased only on the website oscloud.photos (technically it is not possible in the mobile app) and paid by card through Stripe. The subscription renews automatically (monthly or yearly) until the user cancels it. Prices are in the [pricing](' . url('pricing') . ').',
                    '**Cancelling the subscription:** the data is not deleted and stays within the free limit (10 GB). If the limit is exceeded, new files cannot be uploaded until the data is reduced or the subscription is renewed.',
                    '**Data location:** servers of Hetzner Online GmbH in Germany, within the EU.',
                    'Stripe processes payment data separately. The provider neither sees nor stores card numbers; it receives only information about the payment status.',
                ]],
            ],
        ],
        [
            'title' => 'Appendix B: Matrix chat and fediverse services',
            'body'  => [
                ['list' => [
                    'Matrix (mxchat.cz) and fediverse services are **federated**. Messages and public posts are transferred to the servers of other participants. After deletion on the provider’s server, they may not be deleted on third-party servers, over which the provider has no influence.',
                    'Registration on mxchat.cz takes place after approval by the administrator, to prevent abuse.',
                    'Moderators may hide or remove content that violates the rules of the instance or these conditions, and may restrict or block an account. Instances may block servers that spread abusive content.',
                    'For instances with a custom domain, the domain name does not change after launch (see article 11).',
                ]],
            ],
        ],
        [
            'title' => 'Appendix C: Password manager (Vaultwarden, pass.oscloud.cz)',
            'body'  => [
                ['list' => [
                    '**Encryption:** the contents of the vault (passwords, notes, files) are encrypted on the user’s device before being sent to the server. The provider has no access to the contents of the vault. It sees only the e-mail address, the time of registration and login, and the encrypted data.',
                    '**Master password:** it is the only way to access the vault. If it is lost, the data cannot be recovered, not even by the provider. The user is responsible for keeping it safe. Turning on two-step login and storing a backup code outside the vault is recommended.',
                    '**Registration:** it is open and takes place without approval. The provider may restrict or cancel an account in case of abuse of the service, for example mass automated registrations or spam.',
                    '**Your own copy:** the user regularly exports the vault and stores it outside the service. Server backups are not used to restore individual vaults (see article 9).',
                    '**Cancelling the account:** on request the provider deletes the account and all encrypted data. It is removed from backups gradually, according to the backup rotation.',
                    'Unless the pricing states otherwise, the provisions on free services in article 2 apply to the service.',
                ]],
            ],
        ],
    ],
];
