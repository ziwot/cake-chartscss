<?php
declare(strict_types=1);

namespace ChartsCss\Test\TestCase;

use Cake\Http\Response;
use Cake\Http\ServerRequest as Request;
use Cake\TestSuite\TestCase;
use Cake\View\View;
use ChartsCss\View\Helper\ChartHelper;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;

class ChartHelperTest extends TestCase
{
    /**
     * @var \Cake\View\View
     */
    protected $View;

    /**
     * @var ChartHelper
     */
    protected ChartHelper $Chart;

    public function setUp(): void
    {
        parent::setUp();

        $request = new Request();
        $response = new Response();
        $this->View = new View($request, $response);

        $this->Chart = new ChartHelper($this->View);
    }

    #[DataProvider('chartProvider')]
    public function testMake($data, $options, $expectedHtml)
    {
        $this->assertXmlStringEqualsXmlString(
            $expectedHtml,
            $this->Chart->make($data, $options),
        );
    }

    public static function chartProvider(): Generator
    {
        yield [[
            2020 => '$ .6',
            2021 => '$ .7',
            2022 => '$ .77',
            2023 => '$ .73',
            2024 => '$ .80',
            2025 => .88,
        ], [
            'caption' => 'Coffee Value',
            'table' => 'area show-heading show-labels data-outside show-primary-axis show-4-secondary-axes',
        ], '
<table class="charts-css area show-heading show-labels data-outside show-primary-axis show-4-secondary-axes">
    <caption>Coffee Value</caption>
    <tbody>
        <tr><th>2020</th><td style="--start: 0.000000; --end: 0.682000"><span class="data">$ .6</span></td></tr>
        <tr><th>2021</th><td style="--start: 0.682000; --end: 0.795000"><span class="data">$ .7</span></td></tr>
        <tr><th>2022</th><td style="--start: 0.795000; --end: 0.875000"><span class="data">$ .77</span></td></tr>
        <tr><th>2023</th><td style="--start: 0.875000; --end: 0.830000"><span class="data">$ .73</span></td></tr>
        <tr><th>2024</th><td style="--start: 0.830000; --end: 0.909000"><span class="data">$ .80</span></td></tr>
        <tr><th>2025</th><td style="--start: 0.909000; --end: 1.000000"><span class="data">0.88</span></td></tr>    
    </tbody>
</table>

'];
    }
}
