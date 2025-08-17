<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputphonecall peer bytes g_a long key_fingerprint phonecallprotocol protocol
 * @return phone.PhoneCall
 */

final class ConfirmCall extends Instance {
	public function request(object $peer,string $g_a,int $key_fingerprint,object $protocol) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2efe1722);
		$writer->write($peer->read());
		$writer->tgwriteBytes($g_a);
		$writer->writeLong($key_fingerprint);
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