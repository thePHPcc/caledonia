<?php declare(strict_types=1);
namespace example\caledonia\application;

use function file_get_contents;
use function range;
use function str_replace;
use example\caledonia\domain\Market;

final readonly class MarketHtmlProjector
{
    public function project(Market $market): string
    {
        $priceTables = $market->priceTables();

        $rowTemplate = file_get_contents(__DIR__ . '/../../../templates/market_row.html');
        $rows        = '';

        foreach (range(9, 1) as $row) {
            /** @var int<1,9> $row */
            $rows .= str_replace(
                [
                    '{wool}',
                    '{wool_active}',
                    '{grain}',
                    '{grain_active}',
                    '{milk}',
                    '{milk_active}',
                    '{bread}',
                    '{bread_active}',
                    '{cheese}',
                    '{cheese_active}',
                    '{whisky}',
                    '{whisky_active}',
                ],
                [
                    $priceTables['wool']->at($row)->asInt(),
                    $priceTables['wool']->currentPosition() === $row ? ' class="active"' : '',
                    $priceTables['grain']->at($row)->asInt(),
                    $priceTables['grain']->currentPosition() === $row ? ' class="active"' : '',
                    $priceTables['milk']->at($row)->asInt(),
                    $priceTables['milk']->currentPosition() === $row ? ' class="active"' : '',
                    $priceTables['bread']->at($row)->asInt(),
                    $priceTables['bread']->currentPosition() === $row ? ' class="active"' : '',
                    $priceTables['cheese']->at($row)->asInt(),
                    $priceTables['cheese']->currentPosition() === $row ? ' class="active"' : '',
                    $priceTables['whisky']->at($row)->asInt(),
                    $priceTables['whisky']->currentPosition() === $row ? ' class="active"' : '',
                ],
                $rowTemplate,
            );
        }

        return str_replace(
            '{rows}',
            $rows,
            file_get_contents(__DIR__ . '/../../../templates/market_page.html'),
        );
    }
}
