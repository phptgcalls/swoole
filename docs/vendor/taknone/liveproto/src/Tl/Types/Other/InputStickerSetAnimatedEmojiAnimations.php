<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return InputStickerSet
 */

final class InputStickerSetAnimatedEmojiAnimations extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcde3739);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>