<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Premium;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<Boost> boosts Vector<User> users string next_offset
 * @return premium.BoostsList
 */

final class BoostsList extends Instance {
	public function request(int $count,array $boosts,array $users,? string $next_offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x86f8613c);
		$flags = 0;
		$flags |= is_null($next_offset) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		$writer->tgwriteVector($boosts,'Boost');
		if(is_null($next_offset) === false):
			$writer->tgwriteBytes($next_offset);
		endif;
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['count'] = $reader->readInt();
		$result['boosts'] = $reader->tgreadVector('Boost');
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