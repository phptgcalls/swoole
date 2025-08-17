<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot inputpeer peer long random_id string start_param
 * @return Updates
 */

final class StartBot extends Instance {
	public function request(object $bot,object $peer,int $random_id,string $start_param) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe6df7378);
		$writer->write($bot->read());
		$writer->write($peer->read());
		$writer->writeLong($random_id);
		$writer->tgwriteBytes($start_param);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>