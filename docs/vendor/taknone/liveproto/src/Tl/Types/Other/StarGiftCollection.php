<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int collection_id string title int gifts_count long hash document icon
 * @return StarGiftCollection
 */

final class StarGiftCollection extends Instance {
	public function request(int $collection_id,string $title,int $gifts_count,int $hash,? object $icon = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9d6b13b0);
		$flags = 0;
		$flags |= is_null($icon) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($collection_id);
		$writer->tgwriteBytes($title);
		if(is_null($icon) === false):
			$writer->write($icon->read());
		endif;
		$writer->writeInt($gifts_count);
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['collection_id'] = $reader->readInt();
		$result['title'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['icon'] = $reader->tgreadObject();
		else:
			$result['icon'] = null;
		endif;
		$result['gifts_count'] = $reader->readInt();
		$result['hash'] = $reader->readLong();
		return new self($result);
	}
}

?>