<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<StarRefProgram> suggested_bots Vector<User> users string next_offset
 * @return payments.SuggestedStarRefBots
 */

final class SuggestedStarRefBots extends Instance {
	public function request(int $count,array $suggested_bots,array $users,? string $next_offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb4d5d859);
		$flags = 0;
		$flags |= is_null($next_offset) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		$writer->tgwriteVector($suggested_bots,'StarRefProgram');
		$writer->tgwriteVector($users,'User');
		if(is_null($next_offset) === false):
			$writer->tgwriteBytes($next_offset);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['count'] = $reader->readInt();
		$result['suggested_bots'] = $reader->tgreadVector('StarRefProgram');
		$result['users'] = $reader->tgreadVector('User');
		if($flags & (1 << 0)):
			$result['next_offset'] = $reader->tgreadBytes();
		else:
			$result['next_offset'] = null;
		endif;
		return new self($result);
	}
}

?>