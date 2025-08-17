<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url long webpage_id long author_photo_id string author int date Vector<PageBlock> blocks pagecaption caption
 * @return PageBlock
 */

final class PageBlockEmbedPost extends Instance {
	public function request(string $url,int $webpage_id,int $author_photo_id,string $author,int $date,array $blocks,object $caption) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf259a80b);
		$writer->tgwriteBytes($url);
		$writer->writeLong($webpage_id);
		$writer->writeLong($author_photo_id);
		$writer->tgwriteBytes($author);
		$writer->writeInt($date);
		$writer->tgwriteVector($blocks,'PageBlock');
		$writer->write($caption->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['url'] = $reader->tgreadBytes();
		$result['webpage_id'] = $reader->readLong();
		$result['author_photo_id'] = $reader->readLong();
		$result['author'] = $reader->tgreadBytes();
		$result['date'] = $reader->readInt();
		$result['blocks'] = $reader->tgreadVector('PageBlock');
		$result['caption'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>