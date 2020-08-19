# oc-themeupdate-plugin
Theme updates for OctoberCMS

## Extend theme with child theme
You can extend a theme with partials and content files.

Themes folder structure
```
super-cool-theme/
    content/
        test.htm
    theme.yaml

super-cool-theme-child/
    content/
        test.htm
    theme.yaml
```

`super-cool-theme-child/theme.yaml` content
``` yaml
name: Super Cool Theme Child
description: 'Child theme for Super Cool Theme'
author: Acme
homepage: acme.dev/themes/super-cool-theme
code: acme-super-cool-child
extends: acme-super-cool
```

The plugin will check if the child theme contains the content requested by the controller. If it exists, the content of the child theme will be used.
