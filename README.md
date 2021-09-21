# Instructions

Add this config for each postgres connection

```
'options'  => [
    PDO::ATTR_EMULATE_PREPARES => true,
],
```
