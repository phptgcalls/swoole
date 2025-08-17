<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id int random_id bytes g_a_hash phonecallprotocol protocol true video
 * @return phone.PhoneCall
 */

final class RequestCall extends Instance {
	public function request(object $user_id,int $random_id,string $g_a_hash,object $protocol,? true $video = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x42ff96ed);
		$flags = 0;
		$flags |= is_null($video) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($user_id->read());
		$writer->writeInt($random_id);
		$writer->tgwriteBytes($g_a_hash);
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