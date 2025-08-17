<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash int date long admin_id long participant_id bytes g_a_or_b long key_fingerprint phonecallprotocol protocol Vector<PhoneConnection> connections int start_date true p2p_allowed true video true conference_supported datajson custom_parameters
 * @return PhoneCall
 */

final class PhoneCall extends Instance {
	public function request(int $id,int $access_hash,int $date,int $admin_id,int $participant_id,string $g_a_or_b,int $key_fingerprint,object $protocol,array $connections,int $start_date,? true $p2p_allowed = null,? true $video = null,? true $conference_supported = null,? object $custom_parameters = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x30535af5);
		$flags = 0;
		$flags |= is_null($p2p_allowed) ? 0 : (1 << 5);
		$flags |= is_null($video) ? 0 : (1 << 6);
		$flags |= is_null($conference_supported) ? 0 : (1 << 8);
		$flags |= is_null($custom_parameters) ? 0 : (1 << 7);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->writeInt($date);
		$writer->writeLong($admin_id);
		$writer->writeLong($participant_id);
		$writer->tgwriteBytes($g_a_or_b);
		$writer->writeLong($key_fingerprint);
		$writer->write($protocol->read());
		$writer->tgwriteVector($connections,'PhoneConnection');
		$writer->writeInt($start_date);
		if(is_null($custom_parameters) === false):
			$writer->write($custom_parameters->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 5)):
			$result['p2p_allowed'] = true;
		else:
			$result['p2p_allowed'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['video'] = true;
		else:
			$result['video'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['conference_supported'] = true;
		else:
			$result['conference_supported'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		$result['admin_id'] = $reader->readLong();
		$result['participant_id'] = $reader->readLong();
		$result['g_a_or_b'] = $reader->tgreadBytes();
		$result['key_fingerprint'] = $reader->readLong();
		$result['protocol'] = $reader->tgreadObject();
		$result['connections'] = $reader->tgreadVector('PhoneConnection');
		$result['start_date'] = $reader->readInt();
		if($flags & (1 << 7)):
			$result['custom_parameters'] = $reader->tgreadObject();
		else:
			$result['custom_parameters'] = null;
		endif;
		return new self($result);
	}
}

?>