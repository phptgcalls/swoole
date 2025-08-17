<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes random_bytes int layer int in_seq_no int out_seq_no decryptedmessage message
 * @return secret.DecryptedMessageLayer
 */

final class DecryptedMessageLayer extends Instance {
	public function request(string $random_bytes,int $layer,int $in_seq_no,int $out_seq_no,object $message) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1be31789);
		$writer->tgwriteBytes($random_bytes);
		$writer->writeInt($layer);
		$writer->writeInt($in_seq_no);
		$writer->writeInt($out_seq_no);
		$writer->write($message->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['random_bytes'] = $reader->tgreadBytes();
		$result['layer'] = $reader->readInt();
		$result['in_seq_no'] = $reader->readInt();
		$result['out_seq_no'] = $reader->readInt();
		$result['message'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>