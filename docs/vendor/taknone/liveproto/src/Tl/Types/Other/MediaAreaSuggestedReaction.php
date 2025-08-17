<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param mediaareacoordinates coordinates reaction reaction true dark true flipped
 * @return MediaArea
 */

final class MediaAreaSuggestedReaction extends Instance {
	public function request(object $coordinates,object $reaction,? true $dark = null,? true $flipped = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x14455871);
		$flags = 0;
		$flags |= is_null($dark) ? 0 : (1 << 0);
		$flags |= is_null($flipped) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($coordinates->read());
		$writer->write($reaction->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['dark'] = true;
		else:
			$result['dark'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['flipped'] = true;
		else:
			$result['flipped'] = false;
		endif;
		$result['coordinates'] = $reader->tgreadObject();
		$result['reaction'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>