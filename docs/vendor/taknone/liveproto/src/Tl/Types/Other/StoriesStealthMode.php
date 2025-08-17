<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int active_until_date int cooldown_until_date
 * @return StoriesStealthMode
 */

final class StoriesStealthMode extends Instance {
	public function request(? int $active_until_date = null,? int $cooldown_until_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x712e27fd);
		$flags = 0;
		$flags |= is_null($active_until_date) ? 0 : (1 << 0);
		$flags |= is_null($cooldown_until_date) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($active_until_date) === false):
			$writer->writeInt($active_until_date);
		endif;
		if(is_null($cooldown_until_date) === false):
			$writer->writeInt($cooldown_until_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['active_until_date'] = $reader->readInt();
		else:
			$result['active_until_date'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['cooldown_until_date'] = $reader->readInt();
		else:
			$result['cooldown_until_date'] = null;
		endif;
		return new self($result);
	}
}

?>