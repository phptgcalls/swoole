<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bool bot bool premium
 * @return RequestPeerType
 */

final class RequestPeerTypeUser extends Instance {
	public function request(? bool $bot = null,? bool $premium = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5f3b8a00);
		$flags = 0;
		$flags |= is_null($bot) ? 0 : (1 << 0);
		$flags |= is_null($premium) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($bot) === false):
			$writer->tgwriteBool($bot);
		endif;
		if(is_null($premium) === false):
			$writer->tgwriteBool($premium);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['bot'] = $reader->tgreadBool();
		else:
			$result['bot'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['premium'] = $reader->tgreadBool();
		else:
			$result['premium'] = null;
		endif;
		return new self($result);
	}
}

?>