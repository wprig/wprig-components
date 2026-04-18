# AI Skill: TGM Plugin Activation

This component allows theme developers to programmatically recommend or require plugins.

## Recipes

### Recommend a Plugin
To recommend a plugin (e.g., Jetpack), add the following to your theme's `functions.php` or a component:

```php
add_filter( 'wprig_tgm_plugins', function( $plugins ) {
    $plugins[] = [
        'name'      => 'Jetpack',
        'slug'      => 'jetpack',
        'required'  => false,
    ];
    return $plugins;
} );
```

### Require a Plugin
To require a plugin that the theme depends on:

```php
add_filter( 'wprig_tgm_plugins', function( $plugins ) {
    $plugins[] = [
        'name'      => 'WP Rig Core',
        'slug'      => 'wp-rig-core',
        'required'  => true,
        'version'   => '1.0.0',
    ];
    return $plugins;
} );
```

## Context
Use this component when you need to ensure the user has specific plugins installed for the theme to function correctly or to provide enhanced features. It integrates with the standard TGMPA workflow.
