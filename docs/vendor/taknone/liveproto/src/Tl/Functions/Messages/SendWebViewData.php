<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot long random_id string button_text string data
 * @return Updates
 */

final class SendWebViewData extends Instance {
	public function request(object $bot,int $random_id,string $button_text,string $data) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdc0242c8);
		$writer->write($bot->read());
		$writer->writeLong($random_id);
		$writer->tgwriteBytes($button_text);
		$writer->tgwriteBytes($data);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>