/your-project
│
├── /models
│   ├── Product.php
│   ├── ClothesProduct.php
│   ├── TechProduct.php
│   ├── Category.php
│   ├── Attribute.php
│   └── AttributeItem.php
│
├── /graphql
│   ├── schema.graphql
│   ├── types
│   │   ├── ProductType.php
│   │   ├── CategoryType.php
│   │   ├── AttributeType.php
│   │   └── AttributeItemType.php
│   ├── mutations
│   │   └── OrderMutation.php
│   └── queries
│       ├── ProductQuery.php
│       └── CategoryQuery.php
│
├── /resolvers
│   ├── ProductResolver.php
│   └── CategoryResolver.php
│
├── /public
│   └── index.php
│
└── composer.json
