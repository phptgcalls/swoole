<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer long bot_id Vector<BotCommand> commands
 * @return Update
 */

final class UpdateBotCommands extends Instance {
	public function request(object $peer,int $bot_id,array $commands) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4d712f2e);
		$writer->write($peer->read());
		$writer->writeLong($bot_id);
		$writer->tgwriteVector($commands,'BotCommand');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['bot_id'] = $reader->readLong();
		$result['commands'] = $reader->tgreadVector('BotCommand');
		return new self($result);
	}
}

?>