<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string name int backdrop_id int center_color int edge_color int pattern_color int text_color int rarity_permille
 * @return StarGiftAttribute
 */

final class StarGiftAttributeBackdrop extends Instance {
	public function request(string $name,int $backdrop_id,int $center_color,int $edge_color,int $pattern_color,int $text_color,int $rarity_permille) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd93d859c);
		$writer->tgwriteBytes($name);
		$writer->writeInt($backdrop_id);
		$writer->writeInt($center_color);
		$writer->writeInt($edge_color);
		$writer->writeInt($pattern_color);
		$writer->writeInt($text_color);
		$writer->writeInt($rarity_permille);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['name'] = $reader->tgreadBytes();
		$result['backdrop_id'] = $reader->readInt();
		$result['center_color'] = $reader->readInt();
		$result['edge_color'] = $reader->readInt();
		$result['pattern_color'] = $reader->readInt();
		$result['text_color'] = $reader->readInt();
		$result['rarity_permille'] = $reader->readInt();
		return new self($result);
	}
}

?>