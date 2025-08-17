<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<User> users string next_offset
 * @return bots.PopularAppBots
 */

final class PopularAppBots extends Instance {
	public function request(array $users,? string $next_offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1991b13b);
		$flags = 0;
		$flags |= is_null($next_offset) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($next_offset) === false):
			$writer->tgwriteBytes($next_offset);
		endif;
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['next_offset'] = $reader->tgreadBytes();
		else:
			$result['next_offset'] = null;
		endif;
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>