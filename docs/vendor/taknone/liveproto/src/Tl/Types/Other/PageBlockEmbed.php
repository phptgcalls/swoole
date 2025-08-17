<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param pagecaption caption true full_width true allow_scrolling string url string html long poster_photo_id int w int h
 * @return PageBlock
 */

final class PageBlockEmbed extends Instance {
	public function request(object $caption,? true $full_width = null,? true $allow_scrolling = null,? string $url = null,? string $html = null,? int $poster_photo_id = null,? int $w = null,? int $h = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa8718dc5);
		$flags = 0;
		$flags |= is_null($full_width) ? 0 : (1 << 0);
		$flags |= is_null($allow_scrolling) ? 0 : (1 << 3);
		$flags |= is_null($url) ? 0 : (1 << 1);
		$flags |= is_null($html) ? 0 : (1 << 2);
		$flags |= is_null($poster_photo_id) ? 0 : (1 << 4);
		$flags |= is_null($w) ? 0 : (1 << 5);
		$flags |= is_null($h) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		if(is_null($url) === false):
			$writer->tgwriteBytes($url);
		endif;
		if(is_null($html) === false):
			$writer->tgwriteBytes($html);
		endif;
		if(is_null($poster_photo_id) === false):
			$writer->writeLong($poster_photo_id);
		endif;
		if(is_null($w) === false):
			$writer->writeInt($w);
		endif;
		if(is_null($h) === false):
			$writer->writeInt($h);
		endif;
		$writer->write($caption->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['full_width'] = true;
		else:
			$result['full_width'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['allow_scrolling'] = true;
		else:
			$result['allow_scrolling'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['url'] = $reader->tgreadBytes();
		else:
			$result['url'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['html'] = $reader->tgreadBytes();
		else:
			$result['html'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['poster_photo_id'] = $reader->readLong();
		else:
			$result['poster_photo_id'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['w'] = $reader->readInt();
		else:
			$result['w'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['h'] = $reader->readInt();
		else:
			$result['h'] = null;
		endif;
		$result['caption'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>