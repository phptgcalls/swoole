<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long bot_id businessbotrecipients recipients businessbotrights rights
 * @return ConnectedBot
 */

final class ConnectedBot extends Instance {
	public function request(int $bot_id,object $recipients,object $rights) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcd64636c);
		$flags = 0;
		$writer->writeInt($flags);
		$writer->writeLong($bot_id);
		$writer->write($recipients->read());
		$writer->write($rights->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['bot_id'] = $reader->readLong();
		$result['recipients'] = $reader->tgreadObject();
		$result['rights'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>