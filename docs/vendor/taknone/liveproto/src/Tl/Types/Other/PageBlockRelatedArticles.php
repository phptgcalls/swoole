<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param richtext title Vector<PageRelatedArticle> articles
 * @return PageBlock
 */

final class PageBlockRelatedArticles extends Instance {
	public function request(object $title,array $articles) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x16115a96);
		$writer->write($title->read());
		$writer->tgwriteVector($articles,'PageRelatedArticle');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['title'] = $reader->tgreadObject();
		$result['articles'] = $reader->tgreadVector('PageRelatedArticle');
		return new self($result);
	}
}

?>