<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer true enabled inputuser bot string custom_description
 * @return Bool
 */

final class SetCustomVerification extends Instance {
	public function request(object $peer,? true $enabled = null,? object $bot = null,? string $custom_description = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8b89dfbd);
		$flags = 0;
		$flags |= is_null($enabled) ? 0 : (1 << 1);
		$flags |= is_null($bot) ? 0 : (1 << 0);
		$flags |= is_null($custom_description) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($bot) === false):
			$writer->write($bot->read());
		endif;
		$writer->write($peer->read());
		if(is_null($custom_description) === false):
			$writer->tgwriteBytes($custom_description);
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