<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputphonecall peer int rating string comment true user_initiative
 * @return Updates
 */

final class SetCallRating extends Instance {
	public function request(object $peer,int $rating,string $comment,? true $user_initiative = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x59ead627);
		$flags = 0;
		$flags |= is_null($user_initiative) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($rating);
		$writer->tgwriteBytes($comment);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>