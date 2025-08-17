<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string username true editable true active
 * @return Username
 */

final class Username extends Instance {
	public function request(string $username,? true $editable = null,? true $active = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb4073647);
		$flags = 0;
		$flags |= is_null($editable) ? 0 : (1 << 0);
		$flags |= is_null($active) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($username);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['editable'] = true;
		else:
			$result['editable'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['active'] = true;
		else:
			$result['active'] = false;
		endif;
		$result['username'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>