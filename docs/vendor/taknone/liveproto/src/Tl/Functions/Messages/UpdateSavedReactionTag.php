<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param reaction reaction string title
 * @return Bool
 */

final class UpdateSavedReactionTag extends Instance {
	public function request(object $reaction,? string $title = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x60297dec);
		$flags = 0;
		$flags |= is_null($title) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($reaction->read());
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>