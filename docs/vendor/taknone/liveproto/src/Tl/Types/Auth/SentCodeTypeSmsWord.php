<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string beginning
 * @return auth.SentCodeType
 */

final class SentCodeTypeSmsWord extends Instance {
	public function request(? string $beginning = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa416ac81);
		$flags = 0;
		$flags |= is_null($beginning) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($beginning) === false):
			$writer->tgwriteBytes($beginning);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['beginning'] = $reader->tgreadBytes();
		else:
			$result['beginning'] = null;
		endif;
		return new self($result);
	}
}

?>