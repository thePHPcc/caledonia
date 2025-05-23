<?php declare(strict_types=1);
namespace example\caledonia\application;

use function assert;
use function file_get_contents;
use function range;
use function str_replace;
use example\caledonia\domain\Market;

/**
 * @no-named-arguments
 */
final readonly class MarketHtmlProjector
{
    public function project(Market $market): string
    {
        $priceTables = $market->priceTables();
        $rows        = '';

        $rowTemplate = file_get_contents(__DIR__ . '/../../../templates/market_row.html');

        assert($rowTemplate !== false);

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
                    (string) $priceTables['wool']->at($row)->asInt(),
                    $priceTables['wool']->currentPosition() === $row ? ' class="active"' : '',
                    (string) $priceTables['grain']->at($row)->asInt(),
                    $priceTables['grain']->currentPosition() === $row ? ' class="active"' : '',
                    (string) $priceTables['milk']->at($row)->asInt(),
                    $priceTables['milk']->currentPosition() === $row ? ' class="active"' : '',
                    (string) $priceTables['bread']->at($row)->asInt(),
                    $priceTables['bread']->currentPosition() === $row ? ' class="active"' : '',
                    (string) $priceTables['cheese']->at($row)->asInt(),
                    $priceTables['cheese']->currentPosition() === $row ? ' class="active"' : '',
                    (string) $priceTables['whisky']->at($row)->asInt(),
                    $priceTables['whisky']->currentPosition() === $row ? ' class="active"' : '',
                ],
                $rowTemplate,
            );
        }

        $pageTemplate = file_get_contents(__DIR__ . '/../../../templates/market_page.html');

        assert($pageTemplate !== false);

        return str_replace(
            '{rows}',
            $rows,
            $pageTemplate,
        );
    }
}
