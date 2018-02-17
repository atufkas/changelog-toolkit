<?php

namespace atufkas\ProgressKeeper\Tests;


use atufkas\ProgressKeeper\Presenter\HtmlPresenter;
use atufkas\ProgressKeeper\Presenter\MarkdownPresenter;

/**
 * Class PresenterTest
 * @package atufkas\ProgressKeeper\Tests
 */
class PresenterTest extends JsonSampleTestCase
{
    /**
     * @test
     * @throws \atufkas\ProgressKeeper\ChangelogException
     * @throws \atufkas\ProgressKeeper\LogEntry\LogEntryException
     * @throws \atufkas\ProgressKeeper\Release\ReleaseException
     */
    public function testHtmlPresenter()
    {
        $htmlPresenter = new HtmlPresenter();
        $htmlPresenter->setChangelog(static::getChangelogFromSampleFile());
        $htmlChangelog = $htmlPresenter->getOutput();

        $this->assertStringStartsWith('<div class="pk">', $htmlChangelog);
        $this->assertStringEndsWith("</div>\n", $htmlChangelog);
    }

    /**
     * @test
     * @throws \atufkas\ProgressKeeper\ChangelogException
     * @throws \atufkas\ProgressKeeper\LogEntry\LogEntryException
     * @throws \atufkas\ProgressKeeper\Release\ReleaseException
     */
    public function testMarkdownPresenter()
    {
        $markdownPresenter = new MarkdownPresenter();
        $markdownPresenter->setChangelog(static::getChangelogFromSampleFile());
        $markdownChangelog = $markdownPresenter->getOutput();

        $this->assertStringStartsWith('# PK Sample-App', $markdownChangelog);
        $this->assertContains("## 0.1.0", $markdownChangelog);
        $this->assertContains("- [feat]", $markdownChangelog);
        $this->assertContains("- [fix]", $markdownChangelog);
        $this->assertContains("- [upd]", $markdownChangelog);
    }
}