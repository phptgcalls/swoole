<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<int> colors
 * @return help.PeerColorSet
 */

final class PeerColorSet extends Instance {
	public function request(array $colors) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x26219a58);
		$writer->tgwriteVector($colors,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['colors'] = $reader->tgreadVector('int');
		return new self($result);
	}
}

?>