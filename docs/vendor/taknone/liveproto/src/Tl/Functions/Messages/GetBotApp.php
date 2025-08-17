<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputbotapp app long hash
 * @return messages.BotApp
 */

final class GetBotApp extends Instance {
	public function request(object $app,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x34fdc5c3);
		$writer->write($app->read());
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>