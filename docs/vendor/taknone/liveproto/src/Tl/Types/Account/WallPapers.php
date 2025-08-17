<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<WallPaper> wallpapers
 * @return account.WallPapers
 */

final class WallPapers extends Instance {
	public function request(int $hash,array $wallpapers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcdc3858c);
		$writer->writeLong($hash);
		$writer->tgwriteVector($wallpapers,'WallPaper');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['wallpapers'] = $reader->tgreadVector('WallPaper');
		return new self($result);
	}
}

?>