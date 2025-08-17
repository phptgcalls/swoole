<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<HighScore> scores Vector<User> users
 * @return messages.HighScores
 */

final class HighScores extends Instance {
	public function request(array $scores,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9a3bfd99);
		$writer->tgwriteVector($scores,'HighScore');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['scores'] = $reader->tgreadVector('HighScore');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>