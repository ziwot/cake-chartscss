<?php
declare(strict_types=1);

namespace ChartsCss\View\Helper;

use Cake\Collection\Collection;
use Cake\View\Helper;

/**
 * @property \Cake\View\Helper\HtmlHelper $Html
 */
class ChartHelper extends Helper
{
    protected array $helpers = ['Html'];

    /**
     * @param array $data
     * @param array $options
     * @return string
     */
    public function make(array $data, array $options): string
    {
        $max = max(collection($data)->map(fn($v) => $this->floatval($v))->toList());
        $min = min(collection($data)->map(fn($v) => $this->floatval($v))->toList());

        if (strstr($options['table'], 'area') || strstr($options['table'], 'line')) {
            $data = array_combine(
                array_keys($data),
                collection($data)
                    ->take(count($data) - 1)
                    ->prependItem($min)
                    ->zip($data)
                    ->toList(),
            );
        }

        $data = (new Collection($data))
            ->map(fn($v, $k) => $this->Html->tableRow(
                ($k ? "<th>$k</th>" : '') .
                $this->Html->tableCell(
                    sprintf('<span class="data">%s</span>', is_array($v) ? $v[1] : $v),
                    [
                    'style' => is_array($v)
                        ? sprintf(
                            '--start: %f; --end: %f',
                            round(($this->floatval($v[0]) - $min) / ($max - $min), 3),
                            round(($this->floatval($v[1]) - $min) / ($max - $min), 3),
                        )
                        : sprintf(
                            '--size: %f',
                            round(($this->floatval($v) - $min) / ($max - $min), 3),
                        ),
                    ],
                ),
            ));

        return $this->getView()->element('ChartsCss.Chart/chart', [
            'tbodyContents' => implode("\n", $data->toList()),
            'tableOptions' => $options['table'],
            'caption' => $options['caption'],
        ]);
    }

    /**
     * Take a value and returns a float
     *
     * @param mixed $v
     * @return float
     */
    private function floatval(mixed $v): float
    {
        if (is_string($v)) {
            $v = preg_replace('/[^-0-9\.]/', '', $v);
        }

        return floatval($v);
    }
}
