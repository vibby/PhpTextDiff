<?php

declare(strict_types=1);

use PhpTextDiff\FineDiff;
use PHPUnit\Framework\TestCase;

final class FineDiffTest extends TestCase
{
    public function testCanFindCharactersAdditions(): void
    {
        $diff = new FineDiff('text', 'textadded', FineDiff::$characterGranularity);
        $this->assertEquals(
            $diff->renderDiffToHTML(),
            'text<ins>added</ins>'
        );
    }

    public function testCanFindCharactersDeletion(): void
    {
        $diff = new FineDiff('textbefore', 'text', FineDiff::$characterGranularity);
        $this->assertEquals(
            $diff->renderDiffToHTML(),
            'text<del>before</del>'
        );
    }

    public function testCanFindCharactersChanging(): void
    {
        $diff = new FineDiff('text', 'taxt', FineDiff::$characterGranularity);
        $this->assertEquals(
            $diff->renderDiffToHTML(),
            't<del>e</del><ins>a</ins>xt'
        );
    }

    public function testCanFindWordsAdditions(): void
    {
        $diff = new FineDiff('text ', 'text added', FineDiff::$wordGranularity);
        $this->assertEquals(
            $diff->renderDiffToHTML(),
            'text <ins>added</ins>'
        );
    }

    public function testCanFindWordsDeletion(): void
    {
        $diff = new FineDiff('text before', 'text ', FineDiff::$wordGranularity);
        $this->assertEquals(
            $diff->renderDiffToHTML(),
            'text <del>before</del>'
        );
    }

    public function testCanFindWordsChanging(): void
    {
        $diff = new FineDiff('text to change', 'text for change', FineDiff::$wordGranularity);
        $this->assertEquals(
            $diff->renderDiffToHTML(),
            'text <del>to </del><ins>for </ins>change'
        );
    }
}

