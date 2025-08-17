<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputphonecall peer bytes g_b phonecallprotocol protocol
 * @return phone.PhoneCall
 */

final class AcceptCall extends Instance {
	public function request(object $peer,string $g_b,object $protocol) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3bd2b4a0);
		$writer->write($peer->read());
		$writer->tgwriteBytes($g_b);
		$writer->write($protocol->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>