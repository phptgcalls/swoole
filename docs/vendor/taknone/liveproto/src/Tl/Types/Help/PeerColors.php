<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int hash Vector<help.PeerColorOption> colors
 * @return help.PeerColors
 */

final class PeerColors extends Instance {
	public function request(int $hash,array $colors) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf8ed08);
		$writer->writeInt($hash);
		$writer->tgwriteVector($colors,'help.PeerColorOption');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readInt();
		$result['colors'] = $reader->tgreadVector('help.PeerColorOption');
		return new self($result);
	}
}

?>