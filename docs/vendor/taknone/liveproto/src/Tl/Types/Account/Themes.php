<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<Theme> themes
 * @return account.Themes
 */

final class Themes extends Instance {
	public function request(int $hash,array $themes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9a3d8c6d);
		$writer->writeLong($hash);
		$writer->tgwriteVector($themes,'Theme');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['themes'] = $reader->tgreadVector('Theme');
		return new self($result);
	}
}

?>