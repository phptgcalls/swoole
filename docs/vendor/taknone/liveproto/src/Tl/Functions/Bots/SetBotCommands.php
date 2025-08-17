<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param botcommandscope scope string lang_code Vector<BotCommand> commands
 * @return Bool
 */

final class SetBotCommands extends Instance {
	public function request(object $scope,string $lang_code,array $commands) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x517165a);
		$writer->write($scope->read());
		$writer->tgwriteBytes($lang_code);
		$writer->tgwriteVector($commands,'BotCommand');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>