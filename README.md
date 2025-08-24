# ChartsCss

![tests](https://github.com/ziwot/cake-chartscss/workflows/tests/badge.svg)
[![Latest Stable Version](https://poser.pugx.org/ziwot/cake-chartscss/v)](https://packagist.org/packages/ziwot/cake-chartscss)
[![Total Downloads](https://poser.pugx.org/ziwot/cake-chartscss/downloads)](https://packagist.org/packages/ziwot/cake-chartscss)
[![Latest Unstable Version](https://poser.pugx.org/ziwot/cake-chartscss/v/unstable)](https://packagist.org/packages/ziwot/cake-chartscss)
[![License](https://poser.pugx.org/ziwot/cake-chartscss/license)](https://packagist.org/packages/ziwot/cake-chartscss)
[![PHP Version Require](https://poser.pugx.org/ziwot/cake-chartscss/require/php)](https://packagist.org/packages/ziwot/cake-chartscss)

ChartsCss plugin for CakePHP

Install with:

```sh
composer require ziwot/cake-chartscss
```

Load the plugin:

```sh
bin/cake plugin load ChartsCss
```

Link assets:

```sh
cake plugin assets symlink
```

You should also add it to your `.gitignore`:

```
# Plugins
/webroot/charts_css
```

Of course, when you deploy to prod, then, copy the assets:

```sh
cake plugin assets copy
```

Example Usage:

```
<?php
/**
 * @var \App\View\AppView $this
 */

$this->append('css', $this->Html->css('ChartsCss.charts.min', ['block' => false]));

$data = [
   2020 => '$ .6',
   2021 => '$ .7',
   2022 => '$ .77',
   2023 => '$ .73',
   2024 => '$ .80',
   2025 => .88,
];
?>
<?= $this->Chart->make($data, [
    'caption' => 'Coffee Value',
    'table' => 'area show-heading show-labels data-outside show-primary-axis show-4-secondary-axes',
]) ?>
```
