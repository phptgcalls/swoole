<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url long webpage_id string title string description long photo_id string author int published_date
 * @return PageRelatedArticle
 */

final class PageRelatedArticle extends Instance {
	public function request(string $url,int $webpage_id,? string $title = null,? string $description = null,? int $photo_id = null,? string $author = null,? int $published_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb390dc08);
		$flags = 0;
		$flags |= is_null($title) ? 0 : (1 << 0);
		$flags |= is_null($description) ? 0 : (1 << 1);
		$flags |= is_null($photo_id) ? 0 : (1 << 2);
		$flags |= is_null($author) ? 0 : (1 << 3);
		$flags |= is_null($published_date) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($url);
		$writer->writeLong($webpage_id);
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($description) === false):
			$writer->tgwriteBytes($description);
		endif;
		if(is_null($photo_id) === false):
			$writer->writeLong($photo_id);
		endif;
		if(is_null($author) === false):
			$writer->tgwriteBytes($author);
		endif;
		if(is_null($published_date) === false):
			$writer->writeInt($published_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['url'] = $reader->tgreadBytes();
		$result['webpage_id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['description'] = $reader->tgreadBytes();
		else:
			$result['description'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['photo_id'] = $reader->readLong();
		else:
			$result['photo_id'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['author'] = $reader->tgreadBytes();
		else:
			$result['author'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['published_date'] = $reader->readInt();
		else:
			$result['published_date'] = null;
		endif;
		return new self($result);
	}
}

?>