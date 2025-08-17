<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int color long background_emoji_id
 * @return PeerColor
 */

final class PeerColor extends Instance {
	public function request(? int $color = null,? int $background_emoji_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb54b5acf);
		$flags = 0;
		$flags |= is_null($color) ? 0 : (1 << 0);
		$flags |= is_null($background_emoji_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($color) === false):
			$writer->writeInt($color);
		endif;
		if(is_null($background_emoji_id) === false):
			$writer->writeLong($background_emoji_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['color'] = $reader->readInt();
		else:
			$result['color'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['background_emoji_id'] = $reader->readLong();
		else:
			$result['background_emoji_id'] = null;
		endif;
		return new self($result);
	}
}

?>