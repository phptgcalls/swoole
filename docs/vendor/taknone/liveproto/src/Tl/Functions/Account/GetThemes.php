<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string format long hash
 * @return account.Themes
 */

final class GetThemes extends Instance {
	public function request(string $format,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7206e458);
		$writer->tgwriteBytes($format);
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>