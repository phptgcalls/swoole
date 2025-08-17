<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stats;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<PublicForward> forwards Vector<Chat> chats Vector<User> users string next_offset
 * @return stats.PublicForwards
 */

final class PublicForwards extends Instance {
	public function request(int $count,array $forwards,array $chats,array $users,? string $next_offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x93037e20);
		$flags = 0;
		$flags |= is_null($next_offset) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		$writer->tgwriteVector($forwards,'PublicForward');
		if(is_null($next_offset) === false):
			$writer->tgwriteBytes($next_offset);
		endif;
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['count'] = $reader->readInt();
		$result['forwards'] = $reader->tgreadVector('PublicForward');
		if($flags & (1 << 0)):
			$result['next_offset'] = $reader->tgreadBytes();
		else:
			$result['next_offset'] = null;
		endif;
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>