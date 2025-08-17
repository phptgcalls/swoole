<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long collectible_id long document_id string title string slug long pattern_document_id int center_color int edge_color int pattern_color int text_color int until
 * @return EmojiStatus
 */

final class EmojiStatusCollectible extends Instance {
	public function request(int $collectible_id,int $document_id,string $title,string $slug,int $pattern_document_id,int $center_color,int $edge_color,int $pattern_color,int $text_color,? int $until = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7184603b);
		$flags = 0;
		$flags |= is_null($until) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($collectible_id);
		$writer->writeLong($document_id);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($slug);
		$writer->writeLong($pattern_document_id);
		$writer->writeInt($center_color);
		$writer->writeInt($edge_color);
		$writer->writeInt($pattern_color);
		$writer->writeInt($text_color);
		if(is_null($until) === false):
			$writer->writeInt($until);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['collectible_id'] = $reader->readLong();
		$result['document_id'] = $reader->readLong();
		$result['title'] = $reader->tgreadBytes();
		$result['slug'] = $reader->tgreadBytes();
		$result['pattern_document_id'] = $reader->readLong();
		$result['center_color'] = $reader->readInt();
		$result['edge_color'] = $reader->readInt();
		$result['pattern_color'] = $reader->readInt();
		$result['text_color'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['until'] = $reader->readInt();
		else:
			$result['until'] = null;
		endif;
		return new self($result);
	}
}

?>