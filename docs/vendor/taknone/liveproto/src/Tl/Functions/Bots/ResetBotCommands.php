<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param botcommandscope scope string lang_code
 * @return Bool
 */

final class ResetBotCommands extends Instance {
	public function request(object $scope,string $lang_code) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3d8de0f9);
		$writer->write($scope->read());
		$writer->tgwriteBytes($lang_code);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>