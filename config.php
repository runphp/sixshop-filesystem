<?php
declare(strict_types=1);

return json_decode(<<<'JSON'
[
  {
    "type": "radio",
    "field": "driver",
    "value": "local",
    "title": "驱动",
    "info": "存储类型",
    "effect": {
      "fetch": ""
    },
    "$required": true,
    "options": [
      {
        "label": "本地",
        "value": "local"
      }
    ],
    "_fc_id": "id_Fdcomcoutbvualc",
    "name": "ref_Fb80mcotvpt7adc",
    "display": true,
    "hidden": false,
    "_fc_drag_tag": "radio"
  },
  {
    "type": "input",
    "field": "root",
    "value": "public/uploads",
    "title": "root",
    "info": "存储根目录",
    "$required": true,
    "props": {
      "type": "text",
      "placeholder": "public/uploads"
    },
    "_fc_id": "id_F4r4mcou0ptzafc",
    "name": "ref_Fcm7mcou0ptzagc",
    "display": true,
    "hidden": false,
    "_fc_drag_tag": "input"
  },
  {
    "type": "input",
    "field": "url",
    "value": "/uploads",
    "title": "url",
    "info": "访问url",
    "$required": true,
    "props": {
      "type": "text",
      "placeholder": "/uploads"
    },
    "_fc_id": "id_Fizwmcou0rbbaic",
    "name": "ref_Fh90mcou0rbbajc",
    "display": true,
    "hidden": false,
    "_fc_drag_tag": "input"
  },
  {
    "type": "input",
    "field": "domain",
    "value": "https://sixshop.ddev.site",
    "title": "domain",
    "info": "访问域名"
  }
]
JSON, true);
